===source===
<?php

class A {
    var $foo;
    function bar() {}
    static abstract function baz() {}
}
===errors===
Abstract function A::baz() cannot contain body
Class A declares abstract method baz() and must therefore be declared abstract
===php_error <=8.4===
PHP Fatal error:  Abstract function A::baz() cannot contain body in Standard input code on line 6
===php_error >=8.5===
PHP Fatal error:  Class A declares abstract method baz() and must therefore be declared abstract in Standard input code on line 6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 13,
              "end": 14
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
                    "name": "foo",
                    "span": {
                      "start": 25,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 29
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 52
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "baz",
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "modifiers": {
                    "is_static": true,
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 90
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
