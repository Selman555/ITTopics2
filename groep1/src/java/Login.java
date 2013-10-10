/*
 * Via deze Servlet kan je de login controleren van de gebruiker parameters: username(string), password(string)
 * Je kan ook een salt opvragen van een gebruiker parameters: RequestSalt(boolean), username(string)
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author glenn_000
 */
@WebServlet(urlPatterns = {"/Login"})
public class Login extends HttpServlet {

    /**
     * Processes requests for both HTTP
     * <code>GET</code> and
     * <code>POST</code> methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/json");
        PrintWriter out = response.getWriter();
        try 
        {
            appdata.Connectie c = new appdata.Connectie();
            try
            { 
                c.openConnectie();
            }
            catch(Exception e)
            {
               //cannot open the connection database is gone void 
            }
            
            
            String username = "";
            String password = "";
            boolean RequestSalt = false;
            StringBuilder sb = new StringBuilder();
            
            
            try
            {
                username = request.getParameter("username");
                RequestSalt = Boolean.parseBoolean(request.getParameter("RequestSalt"));
                password = request.getParameter("password");
            }
            catch(Exception e)
            {
                
            }
            
            if(RequestSalt == true)
            { 
               sb.append("[{\"Salt\":\""+ c.GetSalt(username) +"\"}]");
               out.println(sb.toString());
            }
            else
            {
            
                if(username.equalsIgnoreCase("") && password.equalsIgnoreCase(""))
                {
                    boolean DoesUserExist = false;
                    try
                    {
                        DoesUserExist = c.CheckLogin(username, password);
                    }
                    catch(Exception e)
                    {

                    }

                    if(DoesUserExist)
                    {
                        sb.append("[{\"login\":\"true\"}]");
                    }
                    else
                    {
                       sb.append("[{\"login\":\"false\"}]");
                    }

                    out.println(sb.toString());
                }
            }
            
            
            
        } finally {            
            out.close();
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP
     * <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP
     * <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>
}
