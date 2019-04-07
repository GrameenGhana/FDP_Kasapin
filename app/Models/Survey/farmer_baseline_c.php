<?php
namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class farmer_baseline_c extends Model
{

    protected $fillable = [
        'farmer_id','submission_id', 'bank_account_type_c',
        'annual_living_expenses_c','annual_other_expenses_c',
        'expected_education_expenses_c','number_family_members_c',
        'farmer_comments_c','income_other_than_main_crop_c',
        'frequency_loan_payment_c','gross_income_main_crop_last_year_c',
        'have_bank_account_c','have_credit_c','given_someone_a_loan_c'
        ,'household_savings_c','loan_money_get_back_c','how_much_pay_for_credit_c',
        'loan_amount_c','credit_source_c','credit_amount_c','mobile_money_option_c',
        'net_income_main_crop_last_year_c','planned_investments_c','receives_payment_farm_labor_c',
        'total_expenses_c','expenses_main_crop_last_year_c','total_income_c'
        ,'income_farm_labor_c','income_other_crops_c','want_bank_account_c',
        'frequency_credit_payment_c','family_members_income_dependents_c','profile_c'
    ];

    protected $hidden = [

    ];

    protected $table = 'farmer_baseline_c';

}
