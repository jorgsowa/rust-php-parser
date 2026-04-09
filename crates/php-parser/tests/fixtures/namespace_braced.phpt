===source===
<?php
namespace App\Services {
    class UserService {}
}
namespace App\Models {
    class User {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Services"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 29,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": "UserService",
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
                  "start": 35,
                  "end": 55,
                  "start_line": 3,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 57,
        "start_line": 2,
        "start_col": 0
      }
    },
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
              "start": 68,
              "end": 79,
              "start_line": 5,
              "start_col": 10
            }
          },
          "body": {
            "Braced": [
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
                  "start": 85,
                  "end": 98,
                  "start_line": 6,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 58,
        "end": 100,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100,
    "start_line": 1,
    "start_col": 0
  }
}
