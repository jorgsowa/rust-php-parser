===source===
<?php
$μεταβλητή = "greek";
echo "Value: $μεταβλητή";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "μεταβλητή"
                },
                "span": {
                  "start": 6,
                  "end": 25
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "greek"
                },
                "span": {
                  "start": 28,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Value: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "μεταβλητή"
                    },
                    "span": {
                      "start": 50,
                      "end": 69
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 42,
              "end": 70
            }
          }
        ]
      },
      "span": {
        "start": 37,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
