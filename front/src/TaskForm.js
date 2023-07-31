import React, { useState } from 'react';
import TextField from '@mui/material/TextField';
import Button from '@mui/material/Button';

const TaskForm = ({ onAddTask }) => {
  const [taskName, setTaskName] = useState('');

  const handleInputChange = (event) => {
    setTaskName(event.target.value);
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    if (taskName.trim() !== '') {
      onAddTask(taskName);
      setTaskName('');
    }
  };

  return (
    <form onSubmit={handleSubmit} style={{ display: 'flex', alignItems: 'center' }}>
      <TextField
        label="Назва задачі"
        variant="outlined"
        value={taskName}
        onChange={handleInputChange}
        style={{ flex: 1, marginRight: '8px' }}
      />
      <Button type="submit" variant="contained" color="primary" style={{ height: '56px' }}>
        Додати задачу
      </Button>
    </form>
  );
};

export default TaskForm;