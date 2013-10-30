/*
 * To change this template, choose Tools | Templates
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
 * @author stevenverheyen
 */
@WebServlet(urlPatterns = {"/ToDos"})
public class ToDos extends HttpServlet {
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/json");
        PrintWriter out = response.getWriter();
        try {
            StringBuilder sb = new StringBuilder();
            Boolean getToDo = false;
            
            try {
                getToDo = Boolean.parseBoolean(request.getParameter("getTodo"));
            } catch (Exception e){ }

            if (getToDo == true) {
                appdata.Connectie c = new appdata.Connectie();
                try {
                    c.openConnectie();
                    sb.append("[");
                    sb.append(c.getToDo());
                    sb.append("]");
                } catch (Exception e) {
                }
            } else {
                try {
                    appdata.Connectie c = new appdata.Connectie();
                    c.openConnectie();
                    //c.InsertTodo("TEST 1 WEBSERVICE", "Een test via de webservice", 1, 1, "AON");
                } catch (Exception e) {
                }
            }

            out.println(sb.toString());
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
