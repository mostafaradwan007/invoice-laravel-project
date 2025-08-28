
<!-- Task Settings Tab -->
<div id="task-settings" class="form-content">
    <div class="settings-section">
        <h2 class="section-title">Task Settings</h2>
        <form action="{{ route('task.settings.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-row">
                    <label class="form-label">Default Task Rate</label>
                    <input type="number" class="form-input" placeholder="0.00" step="0.01" name="default_task_rate"
                value="{{ old('default_task_rate', $task->default_task_rate ?? '') }}">
                </div>

                <div class="form-row">
                    <label class="form-label">Currency</label>
                    <select class="form-select" name="currency">

                        <option  value="USD - US Dollar"{{ old('currency', optional($task)->currency) == 'USD - US Dollar' ? 'selected' : '' }}>USD - US Dollar</option>
                        <option value="EUR - Euro"{{ old('currency', optional($task)->currency) == 'EUR - Euro' ? 'selected' : '' }}>EUR - Euro</option>
                        <option value="GBP - British Pound"{{ old('currency', optional($task)->currency) == 'GBP - British Pound' ? 'selected' : '' }}>GBP - British Pound</option>
                        <option value="CAD - Canadian Dollar"{{ old('currency', optional($task)->currency) == 'CAD - Canadian Dollar' ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                    </select>
                </div>
            </div>


            <div class="form-row">
                <label>Auto Start Tasks <br><span style="color: gray;">Automatically start timer when creating a new
                        task</span></label>

                <label class="switch">
                     <input type="hidden" name="auto_start_task" value="No">
                        <input type="checkbox" name="auto_start_task" value="Yes"
                            {{ isset($task) && $task->auto_start_task === 'Yes' ? 'checked' : '' }}>
                 <span class="slider round"></span>
                 <span style="color: gray;"></span></label>
            </div>


            <div class="form-row">
                <label>Show Task End Date <br><span style="color: gray;">Display end date field in task
                        forms</span></label>

                <label class="switch">
                     <input type="hidden" name="show_task_end_date" value="No">
                        <input type="checkbox" name="show_task_end_date" value="Yes"
                            {{ isset($task) && $task->show_task_end_date === 'Yes' ? 'checked' : '' }}>

                 <span class="slider round"></span>
                 <span style="color: gray;"></span></label>

            </div>

            <div class="form-row">
                <label>Task Documents <br><span style="color: gray;">Allow file uploads for tasks</span></label>

                <label class="switch">
                   <input type="hidden" name="task_document" value="No">
                        <input type="checkbox" name="task_document" value="Yes"
                            {{ isset($task) && $task->task_document === 'Yes' ? 'checked' : '' }}>

                 <span class="slider round"></span>
                 <span style="color: gray;"></span></label>

            </div>
            <div class="form-row">
                <label>Show Project On Tasks <br><span style="color: gray;">Display project field in task
                        forms</span></label>

                <label class="switch">
                   <input type="hidden" name="show_project_on_tasks" value="No">
                        <input type="checkbox" name="show_project_on_tasks" value="Yes"
                            {{ isset($task) && $task->show_project_on_tasks === 'Yes' ? 'checked' : '' }}>

                 <span class="slider round"></span>
                 <span style="color: gray;"></span></label>
            </div>



            <div class="form-grid">
                <div class="form-row">
                    <label class="form-label">Round To Nearest <br><span style="color: gray;"></span></label>
                    <select class="form-select" name="round_to_nearest">
                        <option value="No Rounding"{{ old('round_to_nearest', optional($task)->round_to_nearest) == 'No Rounding' ? 'selected' : '' }}>No Rounding</option>
                        <option value="5 Minutes"{{ old('round_to_nearest', optional($task)->round_to_nearest) == '5 Minutes' ? 'selected' : '' }}>5 Minutes</option>
                        <option value="10 Minutes"{{ old('round_to_nearest', optional($task)->round_to_nearest) == '10 Minutes' ? 'selected' : '' }}>10 Minutes</option>
                        <option value="15 Minutes"{{ old('round_to_nearest', optional($task)->round_to_nearest) == '15 Minutes' ? 'selected' : '' }}>15 Minutes</option>
                        <option value="30 Minutes"{{ old('round_to_nearest', optional($task)->round_to_nearest) == '30 Minutes' ? 'selected' : '' }}>30 Minutes</option>
                        <option value="1 Hour"{{ old('round_to_nearest', optional($task)->round_to_nearest) == '1 Hour' ? 'selected' : '' }}>1 Hour</option>
                    </select>
                </div>

                <div class="form-row">
                    <label class="form-label">Default Task Type <br><span style="color: gray;"></span></label>
                    <select class="form-select" name="default_task_type">
                        <option value="Development"{{ old('default_task_type', optional($task)->default_task_type) == 'Development' ? 'selected' : '' }}>Development</option>
                        <option value="Design"{{ old('default_task_type', optional($task)->default_task_type) == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Testing"{{ old('default_task_type', optional($task)->default_task_type) == 'Testing' ? 'selected' : '' }}>Testing</option>
                        <option value="Meeting"{{ old('default_task_type', optional($task)->default_task_type) == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                        <option value="Research"{{ old('default_task_type', optional($task)->default_task_type) == 'Research' ? 'selected' : '' }}>Research</option>
                    </select>
                </div>
            </div>


            <div class=form-row>
                <label>Lock Invoiced Tasks <br><span style="color: gray;">Prevent editing of tasks that have been
                        invoiced</span></label>

                <label class="switch">
                  <input type="hidden" name="lock_invoiced_tasks" value="No">
                        <input type="checkbox" name="lock_invoiced_tasks" value="Yes"
                            {{ isset($task) && $task->lock_invoiced_tasks === 'Yes' ? 'checked' : '' }}>

                 <span class="slider round"></span>
                 <span style="color: gray;"></span></label>
            </div>

            <div class="form-actions">
                <a href="{{ route('task.settings.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save</button>
            </div>

        </form>
    </div>
</div>
