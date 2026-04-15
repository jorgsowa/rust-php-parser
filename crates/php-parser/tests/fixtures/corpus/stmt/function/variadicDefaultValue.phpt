===source===
<?php
function foo(...$foo = []) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "foo",
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
===php_error===
PHP Fatal error:  Variadic parameter cannot have a default value in Standard input code on line 2
Stack trace:
#0 {main}
