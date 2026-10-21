===source===
<?php
function &g() { yield from f(); }
===errors===
Cannot use "yield from" inside a by-reference generator
===php_error <=8.1===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error 8.2===
Cannot load Xdebug - it was already loaded
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "f"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 33,
                                    "end": 34
                                  }
                                }
                              },
                              "span": {
                                "start": 33,
                                "end": 34
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 36
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 36
                  }
                }
              },
              "span": {
                "start": 22,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
