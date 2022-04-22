<?php
/**
 * Tag service.
 */

namespace App\Service;

use App\Entity\Tag;
use App\Repository\TagRepository;

/**
 * Class TagService.
 */
class TagService
{
    /**
     * Tag repository.
     */
    private TagRepository $tagRepository;

    /**
     * TagService constructor.
     *
     * @param \App\Repository\TagRepository           $tagRepository Tag repository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Find tag by Id.
     *
     * @param int $id Tag Id
     *
     * @return \App\Entity\Tag|null Tag entity
     */
    public function findOneById(int $id): ?Tag
    {
        return $this->tagRepository->findOneById($id);
    }

    /**
     * Save Tag.
     *
     * @param \App\Entity\Tag $tag Tag entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Tag $tag): void
    {
        $this->tagRepository->save($tag);
    }

    /**
     * Delete Tag.
     *
     * @param \App\Entity\Tag $tag Tag entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Tag $tag): void
    {
        $this->tagRepository->delete($tag);
    }

    /**
     * Find by title.
     *
     * @param string $title tag title
     *
     * @return \App\Entity\Tag|null Tag entity
     */
    public function findOneByTitle(string $title): ?Tag
    {
        return $this->tagRepository->findOneByTitle($title);
    }
}
