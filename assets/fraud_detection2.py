import sys
import joblib
import pandas as pd

def main():
    # Check if the correct number of arguments is provided
    if len(sys.argv) != 9:
        print("Usage: python predict_fraud.py <Transaction_Amount> <Account_Balance> <Previous_Fraudulent_Activity> <Daily_Transaction_Count> <Avg_Transaction_Amount> <Failed_Transaction_Count> <Acc_Age> <Risk_Score>")
        sys.exit(1)

    # Parse command-line arguments
    try:
        Transaction_Amount = float(sys.argv[1])
        Account_Balance = float(sys.argv[2])
        Previous_Fraudulent_Activity = int(sys.argv[3])
        Daily_Transaction_Count = int(sys.argv[4])
        Avg_Transaction_Amount = float(sys.argv[5])
        Failed_Transaction_Count = int(sys.argv[6])
        Acc_Age = int(sys.argv[7])
        Risk_Score = float(sys.argv[8])
    except ValueError:
        print("Error: Please provide valid numeric values for all arguments.")
        sys.exit(1)

    # Load the trained AdaBoost model, encoder, and scaler
    model = joblib.load(r"E:\emmu_models\AdaBoost_model.pkl")
    encoder = joblib.load(r"E:\emmu_models\encoder.pkl")
    scaler = joblib.load(r"E:\emmu_models\scaler.pkl")

    # Create a DataFrame for the input
    input_data = pd.DataFrame([[
        Transaction_Amount, Account_Balance, Previous_Fraudulent_Activity,
        Daily_Transaction_Count, Avg_Transaction_Amount, Failed_Transaction_Count,
        Acc_Age, Risk_Score
    ]], columns=[
        'Transaction_Amount', 'Account_Balance', 'Previous_Fraudulent_Activity',
        'Daily_Transaction_Count', 'Avg_Transaction_Amount', 'Failed_Transaction_Count',
        'Acc_Age', 'Risk_Score'
    ])

    # Define categorical and numerical columns
    categorical_col_names = ['Previous_Fraudulent_Activity']
    numerical_col_names = [
        'Transaction_Amount', 'Account_Balance', 'Avg_Transaction_Amount',
        'Daily_Transaction_Count', 'Failed_Transaction_Count', 'Acc_Age', 'Risk_Score'
    ]

    # Encode categorical data
    input_data[categorical_col_names] = encoder.transform(input_data[categorical_col_names])

    # Scale numerical columns
    input_data[numerical_col_names] = scaler.transform(input_data[numerical_col_names])

    # Make a prediction
    prediction = model.predict(input_data)

    # Output the result
    print(prediction[0])  # 1 for fraud, 0 for non-fraud

if __name__ == "__main__":
    main()