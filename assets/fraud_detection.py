import sys
import joblib

# Load the pre-trained model
model = joblib.load('all_models.joblib')

# Get transaction details from command line arguments
transaction_details = sys.argv[1:]

# Convert transaction details to the appropriate format
# Assuming transaction_details is a list of features required by the model
# Example: [amount, sender_account, receiver_account, ...]

# Make prediction
is_fraud = model.predict([transaction_details])[0]

# Print the result
print(is_fraud)