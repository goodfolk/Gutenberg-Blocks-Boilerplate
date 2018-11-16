const { registerBlockType } = wp.blocks

registerBlockType('ys-blocks/sample-block', {
  title: 'Sample block',
  icon: 'universal-access-alt',
  category: 'layout',
  edit() {
    return <div className="sample-block">Basic example with JSX! (editor)</div>
  },
  save() {
    return <div className="sample-block">Basic example with JSX! (front)</div>
  }
})
