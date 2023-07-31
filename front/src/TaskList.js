import React from 'react';
import Task from './Task';

const TaskList = ({ tasks, onSelectTask, onDeleteSelectedTasks }) => {
  return (
    <div>
      {tasks.map((task) => (
        <Task
          key={task.id}
          task={task}
          onSelectTask={onSelectTask}
          onDeleteTask={onDeleteSelectedTasks}
        />
      ))}
    </div>
  );
};

export default TaskList;