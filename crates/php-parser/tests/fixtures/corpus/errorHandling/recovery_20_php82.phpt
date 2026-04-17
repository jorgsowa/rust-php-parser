===config===
max_php=8.2
===source===
<?php

class Foo {
    public $bar1;
    publi $foo;
    public $bar;
}
===errors===
expected modifier, found identifier
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "bar1",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 35
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "foo",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "publi"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 46
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 46
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 41,
                "end": 51
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected identifier "publi", expecting "function" or "const" in Standard input code on line 5
