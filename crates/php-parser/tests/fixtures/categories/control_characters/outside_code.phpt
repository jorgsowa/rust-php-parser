===source===
<?php
$a = '';
$b = "";
// 
/*  */
?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "\u0001"
      },
      "span": {
        "start": 0,
        "end": 1
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 7,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "\u0001\f"
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 16
          }
        }
      },
      "span": {
        "start": 7,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 18,
                  "end": 20
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "\u0002"
                },
                "span": {
                  "start": 23,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 27
          }
        }
      },
      "span": {
        "start": 18,
        "end": 28
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 42,
        "end": 44
      }
    },
    {
      "kind": {
        "InlineHtml": "\u0004"
      },
      "span": {
        "start": 44,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
