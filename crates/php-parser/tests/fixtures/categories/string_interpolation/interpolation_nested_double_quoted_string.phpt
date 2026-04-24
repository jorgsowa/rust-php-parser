===source===
<?php
$x = "URI: {$_SERVER["REQUEST_URI"]}";
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "URI: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "_SERVER"
                              },
                              "span": {
                                "start": 18,
                                "end": 26
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "REQUEST_URI"
                              },
                              "span": {
                                "start": 27,
                                "end": 40
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 18,
                          "end": 41
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 43
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
