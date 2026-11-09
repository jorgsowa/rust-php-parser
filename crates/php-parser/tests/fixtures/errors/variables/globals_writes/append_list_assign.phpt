===source===
<?php
[$GLOBALS[]] = $a;
===errors >=8.1===
Cannot append to $GLOBALS
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
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
                        "Value": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "GLOBALS"
                                },
                                "span": {
                                  "start": 7,
                                  "end": 15
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 21,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
