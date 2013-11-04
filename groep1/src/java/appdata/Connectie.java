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

/**
 *
 * @author glenn_000
 */
public class Connectie {
    
    private Connection dbCon;
    
    public void openConnectie() throws Exception
    {
        
        Class.forName("com.mysql.jdbc.Driver");
        
        String dbURL = "jdbc:mysql://localhost:3306/groep1";
        String username ="root";
        String password = "";
       
        Connection dbCon = null;
      
        try {
            
            this.dbCon = DriverManager.getConnection(dbURL, username, password);
                   
        } catch (SQLException ex) {
            ex.printStackTrace();
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
            
        return "";
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
               sb.append("{\"text\": \"" + rs.getString(1) + "\"}");
           }
        }
        catch(Exception e)
        {
            
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
}
