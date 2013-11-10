/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package appdata;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author glenn_000
 */
public class Connectie {
    
    private static Connectie connectie;
    
    private Connection dbCon;
    private boolean isconnectieopen;
    private final String dbURL = "jdbc:mysql://localhost:3306/groep1";
    private final String username ="root";
    private final String password = "";
    
    private Connectie()
    {
        isconnectieopen = false;
    }
    
    public static Connectie getInstance()
    {
        if(connectie == null)
        {
            connectie = new Connectie();
            try
            {
                connectie.openConnectie();
            }
            catch(Exception e)
            {
                System.out.println("Can't create connection with DB");
            }
        }
        return connectie;
    }
    
    private void openConnectie() throws Exception
    {
        
        Class.forName("com.mysql.jdbc.Driver");     
        Connection dbCon = null;
      
        try {
            
            this.dbCon = DriverManager.getConnection(this.dbURL, this.username, this.password);
            this.isconnectieopen = true;       
        } catch (SQLException ex) {
            ex.printStackTrace();
            this.isconnectieopen = false;
        } finally{
           //close connection ,stmt and resultset here
        }
        
    }
    

    
    public ResultSet SelectQry(String query)
    {
        Statement stmt = null;
        ResultSet rs = null;
       
        try
        {
            stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);;

            rs = stmt.executeQuery(query);
            
            if(rs.next())
            {
                return rs;
            }
        }
        catch(Exception e)
        {
            
        }
        finally
        {
            try
            {
                rs.close();
                stmt.close();
            }
            catch(Exception e)
            {
                
            }
        }
           
        return null;
    }
    
    public String CheckLogin(String username, String Password)
    {
        Statement stmt = null;
        ResultSet rs = null;
        
        try
        {
           String query = "SELECT count(*), Mem_level FROM MEMBERS"
                        + " WHERE Mem_USERNAME = '" + username +"'"
                        + " AND Mem_Password = '" + Password + "'";
           
           stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
           rs = stmt.executeQuery(query);
           
           if(rs.next())
           {
               int aantal = rs.getInt(1);              
               if(aantal == 1)
               {
                   return rs.getString("Mem_level");
               }
           }  
        }
        catch(Exception e)
        {
            
        }
        finally
        {
            try
            {
                rs.close();
                stmt.close();
            }
            catch(Exception e)
            {
                
            }
        }
            
        return "-1";
    }
    
    public String GetSalt(String username)
    {
         Statement stmt = null;
         ResultSet rs = null;
        try
        {
            String query = "SELECT count(*), Mem_Salt"
                         + " FROM members"
                         + " WHERE Mem_Username = '" + username + "'";
            
           stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
           rs = stmt.executeQuery(query);
           
           if(rs.next())
           {
               if(rs.getInt(1) == 1)
               {
                   return rs.getString(2);
               }
           }
        }
        catch(Exception e)
        {
            
        }
        finally
        {
            try
            {
                rs.close();
                stmt.close();
            }
            catch(Exception e)
            {
                
            }
        }
        
        return null;
    }
    
    public String getHighScore()
    {
        StringBuilder sb = new StringBuilder();
        
        Statement stmt = null;
        ResultSet rs = null;
        try
        {
            String query = "SELECT HS_Naam, HS_Score"
                         + " FROM highscore"
                         + " ORDER BY HS_Score DESC"
                         + " LIMIT 10";
            
           stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
           rs = stmt.executeQuery(query);
           
           boolean isfirst = true;
           while(rs.next())
           {   
               if(isfirst == false)
               {
                   sb.append(",");
               }
                   
               sb.append("{\"Naam\": \"" + rs.getString("HS_Naam") + "\", \"Score\":\"" + rs.getInt("HS_Score") +"\"}");
               isfirst = false;
           }
           
           return sb.toString();
        }
        catch(Exception e)
        {
            
        }
        finally
        {
            try
            {
                rs.close();
                stmt.close();
            }
            catch(Exception e)
            {
                
            }
        }
        return null;
    }
    
    public void InsertHighScore(String name, int score)
    {
        try
        {
            String sql = "INSERT INTO highscore (HS_Naam, HS_Score)"
                    + "VALUES ('" + name + "'," + score + ")";
            
            dbCon.createStatement().executeUpdate(sql);
            DeleteLowScores();
        }
        catch(Exception e)
        {
            
        }  
    }
    
    private void DeleteLowScores()
    {
        try
        {
            String sql = "DELETE FROM highscore"
                        +" WHERE HS_ID not in("
                        +" select h.HS_ID from highscore AS h"
                        +" JOIN"
                        +"  (SELECT HS_ID FROM highscore ORDER BY HS_Score DESC LIMIT 10)"
                        +"  AS lim"
                        +"  on h.HS_ID = lim.HS_ID)";
            
            dbCon.createStatement().executeUpdate(sql);
        }
        catch(Exception e)
        {
            
        }  
    }
    
    public String getCms(String id, String taalcode)
    {      
        StringBuilder sb = new StringBuilder();
        
        Statement stmt = null;
        ResultSet rs = null;
        try
        {
            String query = "SELECT text" + taalcode
                         + " FROM cms"
                         + " WHERE id_website = '" + id + "'";
            
           stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
           rs = stmt.executeQuery(query);
           
           if(rs.next())
           {
               sb.append("{\"text\": \"").append(rs.getString(1)).append("\"}");
           }
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
        return sb.toString();
    }
    
     public void UpdateCms(String id, String taalcode, String content)
    {
        try
        {
            String sql = "UPDATE cms"
            + " SET cms.text"+ taalcode +" = '" + content
            + "' WHERE cms.id_website = '"+id+"';";
            
            System.out.println(sql);
            
            dbCon.createStatement().executeUpdate(sql);
        }
        catch(Exception e)
        {
            System.out.println("Could not write to database.\r\n"+e.getMessage());
        }  
    }
    
    public void ipLogging (String ip)
    {
        try
        {
            String sql = "INSERT INTO iplogging (ipadress)"
                    + " VALUES ('" + ip + "')";
            
            dbCon.createStatement().executeUpdate(sql);
        }
        catch(Exception e)
        {
            
        }
    }
        
    public void InsertErrorLog(String pagename, String errormessage)
    {
         try
        {
            String sql = "INSERT INTO errorlogging (err_page, err_message)"
                    + " VALUES ('" + pagename + "', '" +errormessage+ "')";
            
            dbCon.createStatement().executeUpdate(sql);
        }
        catch(Exception e)
        {
            
        }
    }
    
    public String getErrorlog()
    {
        StringBuilder sb = new StringBuilder();
        
        Statement stmt = null;
        ResultSet rs = null;
        try
        {
            String query = "SELECT err_page, err_message"
                         + " FROM errorlogging";
            
           stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
           rs = stmt.executeQuery(query);
           
           while(rs.next())
           {
               sb.append("{\"page\": \"" + rs.getString("err_page") + "\", \"message\":\"" + rs.getString("err_message") +"\"}");
           }
        }
        catch(Exception e)
        {
            e.printStackTrace();
        }
        String test = sb.toString();
        return sb.toString();
    }
    
    public void ChangePassword(String username, String Password)
    {
        try
        {
            String sql = "UPDATE members"
            + " SET Mem_Password = '" + Password + "'"
            + " WHERE Mem_Username = '"+username+"'";
            
            dbCon.createStatement().executeUpdate(sql);
        }
        catch(Exception e)
        {
            System.err.println("ChangePassword Query Failed!\r\n" + e.getMessage());
        }
    }
    
    public void ChangeEmail(String username, String email)
    {
        try
        {
            String sql = "UPDATE members"
            + " SET Mem_Email = '" + email + "'"
            + " WHERE Mem_Username = '"+username+"'";
            
            dbCon.createStatement().executeUpdate(sql);
        }
        catch(Exception e)
        {
            System.err.println("ChangeEmail Query Failed!\r\n" + e.getMessage());
        }
    }
    
    public String getToDo()
    {
        StringBuilder sb = new StringBuilder();
        
        Statement stmt = null;
        ResultSet rs = null;
        try
        {
            String query = "SELECT *"
            + " FROM todo"
            + " ORDER BY prioriteit DESC";
            
            stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
            rs = stmt.executeQuery(query);
            
            boolean isfirst = true;
            while(rs.next())
            {
                if(isfirst == false)
                {
                    sb.append(",");
                }
                
                sb.append("{\"Naam\": \"" + rs.getString("naam") + "\", \"Omschrijving\":\"" + rs.getInt("omschrijving") +"\"}");
                isfirst = false;
            }
            
            return sb.toString();
        }
        catch(Exception e)
        { }
        finally
        {
            try
            {
                if(rs != null)
                    rs.close();
                if(stmt != null)
                    stmt.close();
            }
            catch(Exception e)
            {
                
            }
        }
        return null;
    }


    public boolean isIsconnectieopen() {
        return isconnectieopen;
    }
    
    public void closeConnection()
    {
        try {
            this.dbCon.close();
        } 
        catch (SQLException ex) {
            Logger.getLogger(Connectie.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    
}
