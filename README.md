# Farmchain
Won 3rd prize at HACKATHON 2.0

Farmchain is a simple eCommerce website where a farmer can sell his products without any middleman in between directly to the user. Farmchain uses blockchain to provide security , so that no middleman can interfere between the farmer sell process. A transaction id is genreated for all orders so that user can track full details of the product and a qr code is also generated for all sells so that after scanning it we can get all data about the product .

The user needs to add the products in his cart and then simply login to buy the products.

The farmer gets a dashboard with all the analytics like how many sells are done and how much he have earned this month or daily also . In the dashboard the farmer is able to add more products or change the already provided products and can even change the users data also. 

blockchain.py is the file used to run the blockchain , the blockchain is run in the background using cmd command "python blockchain.py" and this way the file creates a blockain which can be accessed on url localhost:5000 and chain can be seen on localhost:5000/chain and mining can be done on localhost:5000/mine to add new data to the blockchain . Registration of new nodes to the blockchain can be done by posting to the chain using a different url . 
