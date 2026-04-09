===source===
<?php
include 'header.php';
include_once 'config.php';
require 'bootstrap.php';
require_once 'autoload.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Include",
              {
                "kind": {
                  "String": "header.php"
                },
                "span": {
                  "start": 14,
                  "end": 26,
                  "start_line": 2,
                  "start_col": 8
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 2,
            "start_col": 0
          }
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
        "Expression": {
          "kind": {
            "Include": [
              "IncludeOnce",
              {
                "kind": {
                  "String": "config.php"
                },
                "span": {
                  "start": 41,
                  "end": 53,
                  "start_line": 3,
                  "start_col": 13
                }
              }
            ]
          },
          "span": {
            "start": 28,
            "end": 53,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 28,
        "end": 55,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Require",
              {
                "kind": {
                  "String": "bootstrap.php"
                },
                "span": {
                  "start": 63,
                  "end": 78,
                  "start_line": 4,
                  "start_col": 8
                }
              }
            ]
          },
          "span": {
            "start": 55,
            "end": 78,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 55,
        "end": 80,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "RequireOnce",
              {
                "kind": {
                  "String": "autoload.php"
                },
                "span": {
                  "start": 93,
                  "end": 107,
                  "start_line": 5,
                  "start_col": 13
                }
              }
            ]
          },
          "span": {
            "start": 80,
            "end": 107,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 80,
        "end": 108,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108,
    "start_line": 1,
    "start_col": 0
  }
}
