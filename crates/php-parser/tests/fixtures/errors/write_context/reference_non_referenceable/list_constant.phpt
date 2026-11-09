===source===
<?php
list(&$a) = FOO;
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
                            "start": 12,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 18,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
