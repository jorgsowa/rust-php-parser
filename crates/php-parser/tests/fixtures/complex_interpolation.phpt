===source===
<?php echo "Value: {$obj->getName()}";
===ast===
{
  "stmts": [
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
                      "MethodCall": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 20,
                            "end": 24,
                            "start_line": 1,
                            "start_col": 20
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "getName"
                          },
                          "span": {
                            "start": 26,
                            "end": 33,
                            "start_line": 1,
                            "start_col": 26
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 35,
                      "start_line": 1,
                      "start_col": 20
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 37,
              "start_line": 1,
              "start_col": 11
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
