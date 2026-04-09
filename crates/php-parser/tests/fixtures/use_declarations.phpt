===source===
<?php
use App\Models\User;
use App\Services\Auth as AuthService;
use function App\Helpers\formatDate;
use const App\Config\VERSION;
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
                  "end": 25,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 25,
                "start_line": 2,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 2,
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
                  "Services",
                  "Auth"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 31,
                  "end": 49,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": "AuthService",
              "span": {
                "start": 31,
                "end": 63,
                "start_line": 3,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 27,
        "end": 65,
        "start_line": 3,
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
                  "formatDate"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 78,
                  "end": 100,
                  "start_line": 4,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 78,
                "end": 100,
                "start_line": 4,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 65,
        "end": 102,
        "start_line": 4,
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
                  "VERSION"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 112,
                  "end": 130,
                  "start_line": 5,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 112,
                "end": 130,
                "start_line": 5,
                "start_col": 10
              }
            }
          ]
        }
      },
      "span": {
        "start": 102,
        "end": 131,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 131,
    "start_line": 1,
    "start_col": 0
  }
}
