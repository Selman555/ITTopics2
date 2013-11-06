/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Enumeration;
import java.util.Hashtable;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import appdata.Connectie;

/**
 *
 * @author glenn_000
 */
@WebServlet(urlPatterns = {"/Highscore"})
public class Highscore extends HttpServlet {
    private Connectie c;

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
        try {
            if(c == null)
            {
                c = new Connectie();
                if(c.isIsconnectieopen() == false)
                {
                    try
                    {
                        c.openConnectie();
                    }
                    catch(Exception e)
                    {

                    }
                }
            }
            else
            {
                if(c.isIsconnectieopen() == false)
                {
                    try
                    {
                        c.openConnectie();
                    }
                    catch(Exception e)
                    {

                    }
                }
            }
            
  
            StringBuilder sb = new StringBuilder();
            
            Boolean getHighscore = false;
            try
            {
                getHighscore = Boolean.parseBoolean(request.getParameter("getHighscore"));
            }
            catch(Exception e)
            {
                
            }
            String name = request.getParameter("Name");
            String score = request.getParameter("Score");
            
            if(getHighscore == true)
            {          
                try
                {
                    sb.append("[");
                    sb.append(c.getHighScore());
                    sb.append("]");
                }
                catch(Exception e)
                {

                }
            }
            else
            {
                if(name.equalsIgnoreCase("") == false && score.equalsIgnoreCase("") == false)
                {
                    try
                    {
                        int scoreToInt = Integer.parseInt(score);
                        c.InsertHighScore(name, scoreToInt);
                    }
                    catch(Exception e)
                    {
                        
                    }
                }
            }
            
            
                       
            out.println(sb.toString());
            
            
            
            
            
//            /* TODO output your page here. You may use following sample code. */
//            out.println("<!DOCTYPE html>");
//            out.println("<html>");
//            out.println("<head>");
//            out.println("<title>Servlet Highscore</title>");            
//            out.println("</head>");
//            out.println("<body>");
//            out.println("<h1>Servlet Highscore at " + request.getContextPath() + "</h1>");
//            out.println("</body>");
//            out.println("</html>");
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
