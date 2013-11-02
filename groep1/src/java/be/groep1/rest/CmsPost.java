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
import javax.ws.rs.QueryParam;
import appdata.Connectie;

/**
 * REST Web Service
 *
 * @author glenn_000
 */
@Path("cmspost")
public class CmsPost {

    @Context
    private UriInfo context;

    /**
     * Creates a new instance of CmsPost
     */
    public CmsPost() {
    }

    /**
     * Retrieves representation of an instance of be.groep1.rest.CmsPost
     * @return an instance of java.lang.String
     */
    @GET
    @Path("gettext")
    @Produces("application/json")
    public String getJson(@QueryParam("id") String id, @QueryParam("taalcode") String taalcode) {
        Connectie c  = new Connectie();
        try
        {
            c.openConnectie();
            return c.getCms(id, taalcode);
        }
        catch(Exception e)
        {
            
        }    
        return "";
    }

    /**
     * PUT method for updating or creating an instance of CmsPost
     * @param content representation for the resource
     * @return an HTTP response with content of the updated or created resource.
     */
    @PUT
    @Path("inserttext")
    @Consumes("application/json")
    public void putJson(@QueryParam("id") String id, @QueryParam("taalcode") String taalcode, String content) {
        
        Connectie c  = new Connectie();
        try
        {
            c.openConnectie();
            c.InsertCms(id, taalcode, content);
        }
        catch(Exception e)
        {
            
        }        
    }
}
