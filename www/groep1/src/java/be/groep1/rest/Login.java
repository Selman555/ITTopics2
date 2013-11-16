/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package be.groep1.rest;

import appdata.Connectie;
import javax.annotation.PreDestroy;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.UriInfo;
import javax.ws.rs.PathParam;
import javax.ws.rs.Consumes;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.GET;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

/**
 * REST Web Service
 *
 * @author glenn_000
 */
@Path("Login")
public class Login {

    @Context
    private UriInfo context;
    private static Connectie c;

    /**
     * Creates a new instance of Login
     */
    public Login() {      
        c = Connectie.getInstance();
    }

    /**
     * Retrieves representation of an instance of be.groep1.rest.Login
     * @return an instance of java.lang.String
     */
    @GET
    @Path("getSalt")
    @Produces("application/json")
    public String getJson(@QueryParam("username") String username) {
        return "[{\"Salt\":\""+ c.GetSalt(username) +"\"}]";
    }

    /**
     * PUT method for updating or creating an instance of Login
     * @param content representation for the resource
     * @return an HTTP response with content of the updated or created resource.
     */
    @GET
    @Path("checkLogin")
    @Produces("application/json")
    public String checkLogin(@QueryParam("username") String username, @QueryParam("password") String password) {
        return "[{\"level\":\"" + c.CheckLogin(username, password) + "\"}]";
    }
    
    @PUT
    @Path("changePassword")
    @Consumes("application/json")
    public void putJson(String content) {
        try
        {
            JSONObject input = new JSONObject(content);
            String username = input.getString("username");
            String password = input.getString("password");
            
            c.ChangePassword(username, password);
        
        } catch (JSONException jsex) {
            System.out.println("Could not parse json.\r\n"+jsex.getMessage());
        } catch(Exception e) {
            System.out.println("Exception put methode.\r\n"+e.getMessage());
        }       
    }
    
    @GET
    @Path("getEmail")
    @Consumes("application/json")
    public String getEmail(@QueryParam("username") String username){
        return c.getEmail(username);
    }
    
    
    @PUT
    @Path("changeEmail")
    @Consumes("application/json")
    public void putJson(Object content) {
        try
        {
            JSONObject input = new JSONObject(content.toString());
            String username = input.getString("username");
            String email = input.getString("email");
            
            c.ChangeEmail(username, email);
        
        } catch (JSONException jsex) {
            System.out.println("Could not parse json.\r\n"+jsex.getMessage());
        } catch(Exception e) {
            System.out.println("Exception put methode.\r\n"+e.getMessage());
        }       
    }
    
    @PreDestroy
    public void destroy() {
        //c.closeConnection();
    }
}
