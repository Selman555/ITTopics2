/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package appdata;

import com.mysql.jdbc.jdbc2.optional.MysqlDataSource;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.SQLWarning;
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
       
        String query ="select count(*) from members";
       
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
        Statement stmt;
        ResultSet rs;
       
        try
        {
            stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);;

            rs = stmt.executeQuery(query);
            
            if(rs.next())
            {
                return rs;
            }
            
            stmt.close();
            rs.close();
        }
        catch(Exception e)
        {
            
        }
           
        return null;
    }
    
    public boolean CheckLogin(String username, String Password)
    {
        Statement stmt;
        ResultSet rs;
        
        try
        {
           String query = "SELECT count(*) FROM MEMBERS"
                        + " WHERE Mem_USERNAME = '" + username +"'"
                        + " AND Mem_Password = '" + Password + "'";
           
           stmt = dbCon.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
           rs = stmt.executeQuery(query);
           
           if(rs.next())
           {
               int aantal = rs.getInt(1);              
               if(aantal == 1)
               {
                   return true;
               }
           }  
        }
        catch(Exception e)
        {
            
        }
            
        return false;
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
        
        return null;
    }
}
