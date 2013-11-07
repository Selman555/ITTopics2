/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package be.groep1.rest;

import javax.ws.rs.core.Context;
import javax.ws.rs.core.UriInfo;
import javax.ws.rs.Consumes;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.GET;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import appdata.Connectie;
import javax.annotation.PreDestroy;
import org.codehaus.jettison.json.JSONException;
import org.codehaus.jettison.json.JSONObject;

/**
 * REST Web Service
 *
 * @author glenn_000
 */
@Path("cmspost")
public class CmsPost {

    @Context
    private UriInfo context;
    private Connectie c;

    /**
     * Creates a new instance of CmsPost
     */
    public CmsPost() {
        c = Connectie.getInstance();
    }
    /**
     * Retrieves representation of an instance of be.groep1.rest.CmsPost
     * @return an instance of java.lang.String
     */
    @GET
    @Path("gettext")
    @Produces("application/json")
    public String getJson(@QueryParam("id") String id, @QueryParam("taalcode") String taalcode) {
        try
        {
            String content = c.getCms(id, taalcode);
            if (content == null || content.equals("")) {
                content = "{ \"text\" : \"Geen tekst gevonden.\" }";
            }
            System.out.println("data send: \r\n"+content);
            return content;
        }
        catch(Exception e)
        {
            System.out.println("data send: \r\n{ \"text\" : \"Server error, sorry.\" }");
            return "{ \"text\" : \"Server error, sorry.\" }";
        }
    }

    /**
     * PUT method for updating or creating an instance of CmsPost
     * @param content representation for the resource
     * @return an HTTP response with content of the updated or created resource.
     */
    @PUT
    @Path("inserttext")
    @Consumes("application/json")
    public void putJson(String json) {

        try
        {
            //JSON parsen
            JSONObject input = new JSONObject(json);
            String id = input.getString("id");
            String taalcode = input.getString("taalcode");
            String content = input.getString("text");
            System.out.println("Ontvangen: \r\n" + id + taalcode + " " + content);
            //Wegschrijven naar database
            c.UpdateCms(id, taalcode, content);
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
