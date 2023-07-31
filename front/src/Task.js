import React, { useState } from 'react';
import Button from '@mui/material/Button';
import Stack from '@mui/material/Stack';

const Task = ({ task, onDeleteTask }) => {
  const [isEditing, setIsEditing] = useState(false);
  const [editedTitle, setEditedTitle] = useState(task.title);

  const handleEditClick = () => {
    setIsEditing(true);
  };

  const handleCancelEdit = () => {
    setIsEditing(false);
  };

  const handleSaveEdit = () => {
    setIsEditing(false);
  };

  return (
    <Stack direction="row" alignItems="center" justifyContent="space-between" spacing={1} mb={2}>
      {isEditing ? (
        <div className="input-popup" style={{ position: 'relative' }}>
          <input
            type="text"
            value={editedTitle}
            onChange={(e) => setEditedTitle(e.target.value)}
          />
          <div className="popup-buttons" style={{ display: 'flex', justify-content: 'space-between', margin-top: '5px' }}>
            <Button variant="outlined" onClick={handleSaveEdit}>
              Зберегти
            </Button>
            <Button variant="outlined" onClick={handleCancelEdit}>
              Відмінити
            </Button>
          </div>
        </div>
      ) : (
        <span>{task.title}</span>
      )}
      <div className='button-block'>
        {isEditing ? null : (
          <Button variant="outlined" onClick={handleEditClick}>
            Редагувати
          </Button>
        )}
        <Button variant="outlined" onClick={() => onDeleteTask(task.id)}>
          Видалити
        </Button>
      </div>
    </Stack>
  );
};

export default Task;