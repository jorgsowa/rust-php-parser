===source===
<?php
class A {
    function f();
    public static function g();
    abstract function h();
}
===errors <=8.4===
Non-abstract method A::f() must contain body
Non-abstract method A::g() must contain body
Class A contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (A::h)
===errors >=8.5===
Non-abstract method A::f() must contain body
Non-abstract method A::g() must contain body
Class A declares abstract method h() and must therefore be declared abstract
===php_error===
PHP Fatal error:  Non-abstract method A::f() must contain body in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 33
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 61,
                      "end": 62
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 65
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 88,
                      "end": 89
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
