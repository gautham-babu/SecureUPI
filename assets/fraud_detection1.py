import sys
import joblib
import pandas as pd

# Load the pre-trained model
model = joblib.load('simplegauthu2_model.pkl')

# Define the columns expected by the model
columns = ['Transaction_Amount', 'Account_Balance', 'Previous_Fraudulent_Activity', 'Daily_Transaction_Count', "Failed_Transaction_Count"]

# Check if the correct number of arguments is provided
if len(sys.argv) != len(columns) + 1:
    print(f"Usage: python {sys.argv[0]} <Transaction_Amount> <Account_Balance> <Previous_Fraudulent_Activity> <Daily_Transaction_Count> <Failed_Transaction_Count>")
    sys.exit(1)

# Get transaction details from command-line arguments
try:
    transaction_details = [float(arg) for arg in sys.argv[1:]]
except ValueError:
    print("All inputs must be numeric. Please provide valid values.")
    sys.exit(1)

# Convert transaction details to DataFrame
transaction_df = pd.DataFrame([transaction_details], columns=columns)

# Make prediction
is_fraud = model.predict(transaction_df)[0]

# Print the result
print(is_fraud)