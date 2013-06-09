<?php

namespace Symfony\Cmf\Bundle\TreeBrowserBundle\Tests\Unit\Tree;

use Symfony\Cmf\Bundle\TreeBrowserBundle\Form\Type\TreeModelType;

class TreeModelTypeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->formView = $this->getMock('Symfony\Component\Form\FormView');
        $this->formBuilder = $this->getMockBuilder(
            'Symfony\Component\Form\FormBuilder'
        )->disableOriginalConstructor()->getMock();

        $this->form = $this->getMockBuilder(
            'Symfony\Component\Form\Form'
        )->disableOriginalConstructor()->getMock();

        $this->optionsResolver = $this->getMock('Symfony\Component\OptionsResolver\OptionsResolverInterface');

        $this->dm = $this->getMockBuilder(
            'Doctrine\ODM\PHPCR\DocumentManager'
        )->disableOriginalConstructor()->getMock();

        $this->tree = $this->getMock('Symfony\Cmf\Bundle\TreeBrowserBundle\Tree\TreeInterface');

        $this->type = new TreeModelType($this->dm, $this->tree);
    }

    public function testBuildForm()
    {
        $this->formBuilder->expects($this->once())
            ->method('addModelTransformer');

        $options = array(
            'root_node' => '/foobar',
            'select_root_node' => false,
        );
        $this->type->buildForm($this->formBuilder, $options);
    }

    public function testBuildView()
    {
        $options = array(
            'root_node' => '/',
            'select_root_node' => false,
            'create_in_overlay' => false,
            'edit_in_overlay' => false,
        );

        $this->type->buildView($this->formView, $this->form, $options);
    }

    public function testDefaultOptions()
    {
        $this->type->setDefaultOptions($this->optionsResolver);
    }
}
