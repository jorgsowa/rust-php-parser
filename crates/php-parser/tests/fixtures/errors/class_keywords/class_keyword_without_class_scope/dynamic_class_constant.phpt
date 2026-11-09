===source===
<?php
function f() {
    echo self::{'Z'};
}
===errors <=8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
Cannot use "self" when no class scope is active
===errors >=8.3===
Cannot use "self" when no class scope is active
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '(' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "ClassConstAccessDynamic": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 34
                          }
                        },
                        "member": {
                          "kind": {
                            "String": "Z"
                          },
                          "span": {
                            "start": 37,
                            "end": 40
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 41
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 42
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
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
