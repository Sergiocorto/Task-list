const TodoHeader = ({ currentTodos, allTodos }: Props) => {
    return (
      <header>
        <h1>Todo App</h1>
        <p>
          Completed: {currentTodos}/{allTodos}
        </p>
      </header>
    );
  };
  
  export default TodoHeader;