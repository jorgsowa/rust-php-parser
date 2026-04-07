===source===
<?php function foo() { $x = 1;
===errors===
unclosed ''}'' opened at Span { start: 21, end: 22 }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
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
                          "start": 23,
                          "end": 25
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 28,
                          "end": 29
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 29
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 30
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
