===source===
<?php function f() { __halt_compiler(); }
===errors===
__halt_compiler() can only be used at the outermost scope
missing closing '}'
===php_error===
PHP Fatal error:  __HALT_COMPILER() can only be used from the outermost scope in Standard input code on line 1
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
                "HaltCompiler": " }"
              },
              "span": {
                "start": 21,
                "end": 41
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
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
