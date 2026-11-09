===source===
<?php
class C {
    public $e = static function () use (&$y) {};
}
===errors <=8.4===
'closures in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Cannot use(...) variables in constant expression
===php_error <=8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot use(...) variables in constant expression in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Closure": {
                        "is_static": true,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [
                          {
                            "name": {
                              "name": "y",
                              "span": {
                                "start": 57,
                                "end": 59
                              }
                            },
                            "by_ref": true,
                            "span": {
                              "start": 56,
                              "end": 59
                            }
                          }
                        ],
                        "return_type": null,
                        "body": [],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 63
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
