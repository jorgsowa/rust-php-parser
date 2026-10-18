===source===
<?php
function foo(...$foo = []) {}
===errors===
Variadic parameter cannot have a default value
===php_error===
PHP Fatal error:  Variadic parameter cannot have a default value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "foo",
                "span": {
                  "start": 22,
                  "end": 26
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 29,
                  "end": 31
                }
              },
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 31
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
