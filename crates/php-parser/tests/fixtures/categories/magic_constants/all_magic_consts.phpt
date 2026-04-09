===source===
<?php echo __LINE__, __FILE__, __DIR__, __FUNCTION__, __CLASS__, __TRAIT__, __METHOD__, __NAMESPACE__;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "MagicConst": "Line"
            },
            "span": {
              "start": 11,
              "end": 19,
              "start_line": 1,
              "start_col": 11
            }
          },
          {
            "kind": {
              "MagicConst": "File"
            },
            "span": {
              "start": 21,
              "end": 29,
              "start_line": 1,
              "start_col": 21
            }
          },
          {
            "kind": {
              "MagicConst": "Dir"
            },
            "span": {
              "start": 31,
              "end": 38,
              "start_line": 1,
              "start_col": 31
            }
          },
          {
            "kind": {
              "MagicConst": "Function"
            },
            "span": {
              "start": 40,
              "end": 52,
              "start_line": 1,
              "start_col": 40
            }
          },
          {
            "kind": {
              "MagicConst": "Class"
            },
            "span": {
              "start": 54,
              "end": 63,
              "start_line": 1,
              "start_col": 54
            }
          },
          {
            "kind": {
              "MagicConst": "Trait"
            },
            "span": {
              "start": 65,
              "end": 74,
              "start_line": 1,
              "start_col": 65
            }
          },
          {
            "kind": {
              "MagicConst": "Method"
            },
            "span": {
              "start": 76,
              "end": 86,
              "start_line": 1,
              "start_col": 76
            }
          },
          {
            "kind": {
              "MagicConst": "Namespace"
            },
            "span": {
              "start": 88,
              "end": 101,
              "start_line": 1,
              "start_col": 88
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 102,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102,
    "start_line": 1,
    "start_col": 0
  }
}
