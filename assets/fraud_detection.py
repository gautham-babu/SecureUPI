import sys
import joblib
import pandas as pd

# Load the pre-trained model
model = joblib.load('assets/fraud_detection_model.pkl')

# Get transaction details from command line arguments
transaction_details = sys.argv[1:]  # Only number and aadhaar are passed
columns = ['number', 'aadhaar']  # Column names expected by the model

# Convert transaction details to DataFrame
transaction_df = pd.DataFrame([transaction_details], columns=columns)

# Make prediction
is_fraud = model.predict(transaction_df)[0]

# Print the result
print(is_fraud)