using Microsoft.AspNetCore.Mvc;
using DemoApi.Data;
using DemoApi.Models;

namespace DemoApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class UsersController : ControllerBase
    {
        private readonly DemoApiDbContext _context;

        public UsersController(DemoApiDbContext context)
        {
            _context = context;
        }

        //GET: api/users
        [HttpGet]
        public IActionResult GetUsers()
        {
            var products = _context.Users.ToList();
            return Ok(products);
        }

        //GET: api/users/1
        [HttpGet("{id}")]
        public IActionResult GetUser(int id)
        {
            var user = _context.Users.Find(id);
            if (user == null) return NotFound();
            return Ok(user);
        }

        //POST: api/users
        [HttpPost]
        public IActionResult CreateUser(User user)
        {
            _context.Users.Add(user);
            _context.SaveChanges();
            return CreatedAtAction(nameof(GetUser), new { id = user.Id }, user);
        }

    }
}
