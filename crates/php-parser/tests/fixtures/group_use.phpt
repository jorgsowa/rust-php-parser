===source===
<?php
use App\{Models\User, Services\Auth};
use function App\Helpers\{format, validate};
use const App\Config\{DB_HOST, DB_PORT};
use App\{Models\User as U, Services\Auth as A};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Models",
                  "User"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 26,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 15,
                "end": 26,
                "start_line": 2,
                "start_col": 9
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "Services",
                  "Auth"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 41,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 28,
                "end": 41,
                "start_line": 2,
                "start_col": 22
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Helpers",
                  "format"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 57,
                  "end": 76,
                  "start_line": 3,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 70,
                "end": 76,
                "start_line": 3,
                "start_col": 26
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "Helpers",
                  "validate"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 57,
                  "end": 86,
                  "start_line": 3,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 78,
                "end": 86,
                "start_line": 3,
                "start_col": 34
              }
            }
          ]
        }
      },
      "span": {
        "start": 44,
        "end": 89,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Config",
                  "DB_HOST"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 99,
                  "end": 118,
                  "start_line": 4,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 111,
                "end": 118,
                "start_line": 4,
                "start_col": 22
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "Config",
                  "DB_PORT"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 99,
                  "end": 127,
                  "start_line": 4,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 120,
                "end": 127,
                "start_line": 4,
                "start_col": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 89,
        "end": 130,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Models",
                  "User"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 134,
                  "end": 151,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "alias": "U",
              "span": {
                "start": 139,
                "end": 155,
                "start_line": 5,
                "start_col": 9
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "Services",
                  "Auth"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 134,
                  "end": 171,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "alias": "A",
              "span": {
                "start": 157,
                "end": 175,
                "start_line": 5,
                "start_col": 27
              }
            }
          ]
        }
      },
      "span": {
        "start": 130,
        "end": 177,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 177,
    "start_line": 1,
    "start_col": 0
  }
}
