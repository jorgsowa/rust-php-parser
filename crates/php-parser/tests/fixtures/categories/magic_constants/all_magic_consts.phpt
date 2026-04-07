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
              "end": 19
            }
          },
          {
            "kind": {
              "MagicConst": "File"
            },
            "span": {
              "start": 21,
              "end": 29
            }
          },
          {
            "kind": {
              "MagicConst": "Dir"
            },
            "span": {
              "start": 31,
              "end": 38
            }
          },
          {
            "kind": {
              "MagicConst": "Function"
            },
            "span": {
              "start": 40,
              "end": 52
            }
          },
          {
            "kind": {
              "MagicConst": "Class"
            },
            "span": {
              "start": 54,
              "end": 63
            }
          },
          {
            "kind": {
              "MagicConst": "Trait"
            },
            "span": {
              "start": 65,
              "end": 74
            }
          },
          {
            "kind": {
              "MagicConst": "Method"
            },
            "span": {
              "start": 76,
              "end": 86
            }
          },
          {
            "kind": {
              "MagicConst": "Namespace"
            },
            "span": {
              "start": 88,
              "end": 101
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 102
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102
  }
}
