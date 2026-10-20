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
              "end": 28
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "UserService",
                      "span": {
                        "start": 41,
                        "end": 52
                      }
                    },
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
                  "end": 55
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 57
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
              "end": 78
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "User",
                      "span": {
                        "start": 91,
                        "end": 95
                      }
                    },
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
                  "end": 98
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 58,
        "end": 100
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100
  }
}
