===source===
<?php
namespace App\Models;
class User {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Models"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 26,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "User",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 28,
        "end": 41,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}
