===source===
<?php
function test() {
    1 +
}
===errors===
expected expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 28,
                          "end": 29
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": "Error",
                        "span": {
                          "start": 32,
                          "end": 33
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 33
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 31
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
