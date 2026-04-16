===source===
<?php abstract class Foo { abstract function bar() { echo 'body'; } }
===errors===
abstract method cannot contain a body
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "body"
                            },
                            "span": {
                              "start": 58,
                              "end": 64
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 53,
                        "end": 65
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 67
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
===php_error===
PHP Fatal error:  Abstract function Foo::bar() cannot contain body in Standard input code on line 1
