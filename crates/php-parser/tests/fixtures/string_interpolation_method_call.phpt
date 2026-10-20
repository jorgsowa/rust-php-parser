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
                            "end": 24
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "getName"
                          },
                          "span": {
                            "start": 26,
                            "end": 33
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 35
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
