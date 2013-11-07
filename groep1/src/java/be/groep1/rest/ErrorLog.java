/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package be.groep1.rest;

import javax.ws.rs.core.Context;
import javax.ws.rs.core.UriInfo;
import javax.ws.rs.PathParam;
import javax.ws.rs.Consumes;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.GET;
import javax.ws.rs.Produces;
import appdata.Connectie;
import javax.annotation.PreDestroy;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

/**
 * REST Web Service
 *
 * @author glenn_000
 */
@Path("ErrorLoging")
public class ErrorLog {

    @Context
    private UriInfo context;
    private static Connectie c;
    /**
     * Creates a new instance of ErrorLog
     */
    public ErrorLog() {
        c = Connectie.getInstance();
    }

    /**
     * Retrieves representation of an instance of be.groep1.rest.ErrorLog
     * @return an instance of java.lang.String
     */
    @GET
    @Path("GetLog")
    @Produces("application/json")
    public String getXml() {
        return c.getErrorlog();
    }

    /**
     * PUT method for updating or creating an instance of ErrorLog
     * @param content representation for the resource
     * @return an HTTP response with content of the updated or created resource.
     */
    @PUT
    @Path("AddLog")
    @Consumes("application/json")
    public void putXml(String content) {  
        try
        {
            //JSON parsen
            JSONObject input = new JSONObject(content);
            String page = input.getString("page");
            String message = input.getString("message");
            //Wegschrijven naar database
            c.InsertErrorLog(page, message);
        } catch (JSONException jsex) {
            System.out.println("Could not parse json.\r\n"+jsex.getMessage());
        } catch(Exception e) {
            System.out.println("Exception put methode.\r\n"+e.getMessage());
        }
    }
    
    @PreDestroy
    public void destroy() {
        c.closeConnection();
    }
}
