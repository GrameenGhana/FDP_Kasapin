<?php
/**
 * Country Trait
 * User: spomega
 * Date: 10/17/18
 * Time: 11:31 AM
 */

namespace App\Models\Survey\Traits\Attribute;


trait FormAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.survey.form.edit', $this).'" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.survey.form.destroy', $this).'"
			 data-method="delete"
			 data-trans-button-cancel"'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function  getAdminButtonAttribute()
    {
        return '<a href="'.route('admin.auth.country.admin.add', $this).'" class="btn btn-primary"><i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.admin').'"></i></a>';
    }


    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {

        return '<div class="btn-group btn-group-sm" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">
			  '.$this->edit_button.'
			  '.$this->delete_button.'
			  '.$this->admin_button.'
			</div>';
    }

}
