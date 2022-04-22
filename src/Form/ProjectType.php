<?php

/**
 * Project form.
 */

namespace App\Form;


use App\Entity\Project;
use App\Entity\Tag;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Form\DataTransformer\TagsDataTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;




/**
 * Class ProjectType.
 */
class ProjectType extends AbstractType
{
    /**
     * Tags data transformer.
     */
    private TagsDataTransformer $tagsDataTransformer;

    /**
     * ElementType constructor.
     *
     * @param \App\Form\DataTransformer\TagsDataTransformer $tagsDataTransformer Tags data transformer
     */
    public function __construct(TagsDataTransformer $tagsDataTransformer)
    {
        $this->tagsDataTransformer = $tagsDataTransformer;
    }
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label_title',
                'required' => true,
                'attr' => ['max_length' => 16],
            ]
        );
        $builder->add(
            'category',
            EntityType::class,
            [
                    'class' => Category::class,
                    'choice_label' => function ($category) {
                        return $category->getTitle();
                    },
                    'label' => 'label_category',
                    'placeholder' => 'label_none',
                    'required' => true,
                ]
        );
        $builder->add(
            'tags',
            EntityType::class,
            [
                    'class' => Tag::class,
                    'choice_label' => function ($tags) {
                        return $tags->getName();
                    },
                    'label' => 'label_tags',
                    'placeholder' => 'label_none',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => true,
                ]
        );
        
 
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Project::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix(): string
    {
        return 'project';
    }
}
