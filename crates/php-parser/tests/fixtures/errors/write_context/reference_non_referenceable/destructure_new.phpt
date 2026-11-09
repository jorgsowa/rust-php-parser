===source===
<?php
[&$a] = new A;
===errors===
Cannot assign reference to non referenceable value
===php_error <=8.0===
PHP Fatal error:  Cannot assign reference to non referencable value in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot assign reference to non referenceable value in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 8,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 14,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
