<?php

namespace Tests\Feature\Usescases\Courses;


use App\Entities\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Usescases\Courses\CreateCourseUsecase;
use PHPUnit\Framework\TestCase;

class CreateCourseUsecaseTest extends TestCase
{


    /**
     * @var CourseRepositoryInterface|\Mockery\MockInterface
     */
    private $courseRepository;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->courseRepository = CourseRepositoryInterface::class;
    }

    /**
     * @dataProvider data_test
     * @param $data
     * @param $course
     */
    public function test_create_course($data, $course)
    {
        $this->courseRepository->shouldReceive('create')->with($data)->andReturn($course);

        $usecase = new CreateCourseUsecase($this->courseRepository);

        $result = $usecase->handle($data);

        $this->assertInstanceOf(Course::class, $result);
        $this->assertEquals($data['title'], $result->title);
    }

    public function data_test()
    {
        $course = new Course();
        $course->title = 'Curso 1';

        $data =  [
            ['data' => [
                'title' => 'Curso 1',
                'description' => 'Descripcion Curso',
                'teacher_id' => 1
            ],
            'course' => $course],
        ];

        return $data;
    }
}
