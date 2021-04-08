<?php
namespace OmniPro\Blog\Api\Data;

interface BlogInterface
{
    /**
     * Return ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * Get Title
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set Title
     * @param string $title
     * @return void
     */
    public function setTitle(string $title);

    /**
     * Get Content
     * @return string
     */
    public function getContent(): string;

    /**
     * Set Content
     * @param string $content
     * @return void
     */
    public function setContent(string $content);

    /**
     * Get Email
     * @return string
     */
    public function getEmail(): string;

    /**
     * Set Email
     * @param string $email
     * @return void
     */
    public function setEmail(string $email);

    /**
     * Get Image
     * @return string
     */
    public function getImg(): string;

    /**
     * Set Image
     * @param string $img
     * @return void
     */
    public function setImg(string $img);
}
