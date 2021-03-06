/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package managercantina;
import java.io.IOException;
import java.net.URL;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.application.Platform;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javax.xml.parsers.ParserConfigurationException;
import org.xml.sax.SAXException;

/**
 *
 * @author Deviza
 */
public class FXMLDocumentController implements Initializable {
    
    @FXML
    private TableView<Mancare> tabel;
    @FXML
    private TableColumn<Mancare, String> numeMancare;
    @FXML
    private TableColumn<Mancare, Integer> cantitate;

    @FXML
    private Label label;
    @FXML
    private Button btn;
    
    
    
    @FXML
    private void handleButtonAction(ActionEvent event) throws SQLException, ParserConfigurationException, SAXException, IOException 
    {
        try 
        { 
            String s = DbConnection.getData();
            show_table();
            label.setText(s);
        } 
        
        catch (SQLException ex) 
        {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
            label.setText("Eroare");
        }
    }
    
    @Override
    public void initialize(URL url, ResourceBundle rb)  
    {      
        try 
        {
            if(DbConnection.checkConnection()==false)
            {
                Alert alert = new Alert(AlertType.ERROR);
                alert.setTitle("Error Dialog");
                alert.setHeaderText("Conexiunea cu baza de date nu poate fi stabilită.");
                alert.setContentText("Verificati conexiunea la internet și/sau sau anunțati administratorul aplicației.");
                alert.showAndWait();
                Platform.exit();
                System.exit(0);
            }
        } catch (SQLException ex) {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ParserConfigurationException ex) {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SAXException ex) {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
        }
        numeMancare.setCellValueFactory(new PropertyValueFactory("numeMancare"));
        cantitate.setCellValueFactory(new PropertyValueFactory("cantitate"));    
    }

     @FXML
    private void show_table () throws SQLException, SAXException, IOException, ParserConfigurationException
    {    
        ObservableList<Mancare> lista = FXCollections.observableArrayList();

        ResultSet rs=DbConnection.get_table();
        while(rs.next())
        {
            lista.add(new Mancare(rs.getString("mancare"),rs.getInt("cantitate")));
            for(Mancare m:lista)
            {
                
            }
        }
        tabel.setItems(lista);
    }
    
}
