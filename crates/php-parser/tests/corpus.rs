mod common;
use common::{assert_no_errors, to_json};

fn parse_php(source: &'static str) -> php_rs_parser::ParseResult<'static, 'static> {
    // Leak arena and source for test simplicity — process exits after test run anyway
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, source)
}

macro_rules! fixture_test {
    ($name:ident, $file:expr) => {
        #[test]
        fn $name() {
            let source = include_str!(concat!("fixtures/", $file));
            let result = parse_php(source);
            assert_no_errors(&result);
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
    ($name:ident, $file:expr, errors) => {
        #[test]
        fn $name() {
            let source = include_str!(concat!("fixtures/", $file));
            let result = parse_php(source);
            assert!(
                !result.errors.is_empty(),
                "expected parse errors but found none"
            );
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
}

// =============================================================================
// PHP-Parser corpus fixtures (error handling, expr, scalar, stmt)
// =============================================================================

// error handling
fixture_test!(
    errorhandling_eoferror_1,
    "nikic/errorHandling/eofError_1.php",
    errors
);
fixture_test!(
    errorhandling_eoferror_2,
    "nikic/errorHandling/eofError_2.php",
    errors
);
fixture_test!(
    errorhandling_lexererrors_1,
    "nikic/errorHandling/lexerErrors_1.php"
);
fixture_test!(
    errorhandling_lexererrors_5,
    "nikic/errorHandling/lexerErrors_5.php",
    errors
);
fixture_test!(
    errorhandling_recovery_1,
    "nikic/errorHandling/recovery_1.php",
    errors
);
fixture_test!(
    errorhandling_recovery_2,
    "nikic/errorHandling/recovery_2.php",
    errors
);
fixture_test!(
    errorhandling_recovery_3,
    "nikic/errorHandling/recovery_3.php",
    errors
);
fixture_test!(
    errorhandling_recovery_4,
    "nikic/errorHandling/recovery_4.php",
    errors
);
fixture_test!(
    errorhandling_recovery_5,
    "nikic/errorHandling/recovery_5.php",
    errors
);
fixture_test!(
    errorhandling_recovery_6,
    "nikic/errorHandling/recovery_6.php",
    errors
);
fixture_test!(
    errorhandling_recovery_7,
    "nikic/errorHandling/recovery_7.php",
    errors
);
fixture_test!(
    errorhandling_recovery_8,
    "nikic/errorHandling/recovery_8.php",
    errors
);
fixture_test!(
    errorhandling_recovery_9,
    "nikic/errorHandling/recovery_9.php",
    errors
);
fixture_test!(
    errorhandling_recovery_10,
    "nikic/errorHandling/recovery_10.php",
    errors
);
fixture_test!(
    errorhandling_recovery_11,
    "nikic/errorHandling/recovery_11.php",
    errors
);
fixture_test!(
    errorhandling_recovery_12,
    "nikic/errorHandling/recovery_12.php",
    errors
);
fixture_test!(
    errorhandling_recovery_13,
    "nikic/errorHandling/recovery_13.php",
    errors
);
fixture_test!(
    errorhandling_recovery_14,
    "nikic/errorHandling/recovery_14.php",
    errors
);
fixture_test!(
    errorhandling_recovery_15,
    "nikic/errorHandling/recovery_15.php",
    errors
);
fixture_test!(
    errorhandling_recovery_16,
    "nikic/errorHandling/recovery_16.php",
    errors
);
fixture_test!(
    errorhandling_recovery_17,
    "nikic/errorHandling/recovery_17.php",
    errors
);
fixture_test!(
    errorhandling_recovery_18,
    "nikic/errorHandling/recovery_18.php"
);
fixture_test!(
    errorhandling_recovery_19,
    "nikic/errorHandling/recovery_19.php",
    errors
);
fixture_test!(
    errorhandling_recovery_20,
    "nikic/errorHandling/recovery_20.php",
    errors
);
fixture_test!(
    errorhandling_recovery_21,
    "nikic/errorHandling/recovery_21.php",
    errors
);
fixture_test!(
    errorhandling_recovery_22,
    "nikic/errorHandling/recovery_22.php",
    errors
);
fixture_test!(
    errorhandling_recovery_23,
    "nikic/errorHandling/recovery_23.php",
    errors
);
fixture_test!(
    errorhandling_recovery_24,
    "nikic/errorHandling/recovery_24.php",
    errors
);
fixture_test!(
    errorhandling_recovery_25,
    "nikic/errorHandling/recovery_25.php",
    errors
);
fixture_test!(
    errorhandling_recovery_26,
    "nikic/errorHandling/recovery_26.php",
    errors
);

// expr
fixture_test!(
    expr_alternative_array_syntax_1,
    "nikic/expr/alternative_array_syntax_1.php"
);
fixture_test!(
    expr_alternative_array_syntax_2,
    "nikic/expr/alternative_array_syntax_2.php"
);
fixture_test!(expr_arraydef, "nikic/expr/arrayDef.php");
fixture_test!(expr_arraydestructuring, "nikic/expr/arrayDestructuring.php");
fixture_test!(
    expr_arrayemptyelemens,
    "nikic/expr/arrayEmptyElemens.php",
    errors
);
fixture_test!(expr_arrayspread, "nikic/expr/arraySpread.php");
fixture_test!(expr_arrow_function, "nikic/expr/arrow_function.php");
fixture_test!(expr_assign, "nikic/expr/assign.php");
fixture_test!(expr_assignnewbyref_1, "nikic/expr/assignNewByRef_1.php");
fixture_test!(expr_assignnewbyref_2, "nikic/expr/assignNewByRef_2.php");
fixture_test!(expr_cast, "nikic/expr/cast.php", errors);
fixture_test!(expr_clone, "nikic/expr/clone.php");
fixture_test!(expr_closure, "nikic/expr/closure.php");
fixture_test!(
    expr_closure_use_trailing_comma,
    "nikic/expr/closure_use_trailing_comma.php"
);
fixture_test!(expr_comparison, "nikic/expr/comparison.php");
fixture_test!(expr_concatprecedence_1, "nikic/expr/concatPrecedence_1.php");
fixture_test!(expr_concatprecedence_2, "nikic/expr/concatPrecedence_2.php");
fixture_test!(expr_constant_expr, "nikic/expr/constant_expr.php");
fixture_test!(expr_dynamicclassconst, "nikic/expr/dynamicClassConst.php");
fixture_test!(expr_errorsuppress, "nikic/expr/errorSuppress.php");
fixture_test!(expr_exit, "nikic/expr/exit.php");
fixture_test!(expr_exprinisset, "nikic/expr/exprInIsset.php");
fixture_test!(expr_exprinlist, "nikic/expr/exprInList.php");
fixture_test!(expr_fetchandcall_args, "nikic/expr/fetchAndCall/args.php");
fixture_test!(
    expr_fetchandcall_constfetch,
    "nikic/expr/fetchAndCall/constFetch.php"
);
fixture_test!(
    expr_fetchandcall_constantderef,
    "nikic/expr/fetchAndCall/constantDeref.php"
);
fixture_test!(
    expr_fetchandcall_funccall,
    "nikic/expr/fetchAndCall/funcCall.php"
);
fixture_test!(
    expr_fetchandcall_namedargs,
    "nikic/expr/fetchAndCall/namedArgs.php"
);
fixture_test!(
    expr_fetchandcall_newderef,
    "nikic/expr/fetchAndCall/newDeref.php"
);
fixture_test!(
    expr_fetchandcall_objectaccess,
    "nikic/expr/fetchAndCall/objectAccess.php"
);
fixture_test!(
    expr_fetchandcall_simplearrayaccess,
    "nikic/expr/fetchAndCall/simpleArrayAccess.php"
);
fixture_test!(
    expr_fetchandcall_staticcall,
    "nikic/expr/fetchAndCall/staticCall.php"
);
fixture_test!(
    expr_fetchandcall_staticpropertyfetch,
    "nikic/expr/fetchAndCall/staticPropertyFetch.php"
);
fixture_test!(
    expr_firstclasscallables,
    "nikic/expr/firstClassCallables.php"
);
fixture_test!(expr_includeandeval, "nikic/expr/includeAndEval.php");
fixture_test!(expr_issetandempty, "nikic/expr/issetAndEmpty.php");
fixture_test!(
    expr_keywordsinnamespacedname,
    "nikic/expr/keywordsInNamespacedName.php"
);
fixture_test!(expr_listreferences, "nikic/expr/listReferences.php");
fixture_test!(expr_listwithkeys, "nikic/expr/listWithKeys.php");
fixture_test!(expr_logic, "nikic/expr/logic.php");
fixture_test!(expr_match_1, "nikic/expr/match_1.php");
fixture_test!(expr_match_2, "nikic/expr/match_2.php");
fixture_test!(expr_match_3, "nikic/expr/match_3.php");
fixture_test!(expr_match_4, "nikic/expr/match_4.php");
fixture_test!(expr_match_5, "nikic/expr/match_5.php");
fixture_test!(expr_math, "nikic/expr/math.php");
fixture_test!(expr_new, "nikic/expr/new.php");
fixture_test!(expr_newderef, "nikic/expr/newDeref.php");
fixture_test!(
    expr_newwithoutclass,
    "nikic/expr/newWithoutClass.php",
    errors
);
fixture_test!(expr_nullsafe, "nikic/expr/nullsafe.php");
fixture_test!(expr_pipe, "nikic/expr/pipe.php");
fixture_test!(expr_print, "nikic/expr/print.php");
fixture_test!(expr_shellexec, "nikic/expr/shellExec.php");
fixture_test!(expr_ternaryandcoalesce, "nikic/expr/ternaryAndCoalesce.php");
fixture_test!(expr_throw, "nikic/expr/throw.php");
fixture_test!(expr_trailingcommas, "nikic/expr/trailingCommas.php");
fixture_test!(expr_uvs_constderef, "nikic/expr/uvs/constDeref.php");
fixture_test!(
    expr_uvs_globalnonsimplevarerror,
    "nikic/expr/uvs/globalNonSimpleVarError.php",
    errors
);
fixture_test!(expr_uvs_indirectcall, "nikic/expr/uvs/indirectCall.php");
fixture_test!(expr_uvs_isset, "nikic/expr/uvs/isset.php");
fixture_test!(expr_uvs_misc, "nikic/expr/uvs/misc.php");
fixture_test!(expr_uvs_new, "nikic/expr/uvs/new.php");
fixture_test!(
    expr_uvs_newinstanceofexpr,
    "nikic/expr/uvs/newInstanceofExpr.php"
);
fixture_test!(expr_uvs_staticproperty, "nikic/expr/uvs/staticProperty.php");
fixture_test!(expr_varvarpos, "nikic/expr/varVarPos.php");
fixture_test!(expr_variable, "nikic/expr/variable.php");

// misc
fixture_test!(blockcomments, "nikic/blockComments.php");
fixture_test!(commentatendofclass, "nikic/commentAtEndOfClass.php");
fixture_test!(comments_1, "nikic/comments_1.php");
fixture_test!(comments_2, "nikic/comments_2.php");
fixture_test!(comments_3, "nikic/comments_3.php");
fixture_test!(emptyfile, "nikic/emptyFile.php");
fixture_test!(formattingattributes, "nikic/formattingAttributes.php");
fixture_test!(noppositions_1, "nikic/nopPositions_1.php");
fixture_test!(noppositions_2, "nikic/nopPositions_2.php");
fixture_test!(semireserved, "nikic/semiReserved.php");

// scalar
fixture_test!(scalar_constantstring, "nikic/scalar/constantString.php");
fixture_test!(scalar_docstring, "nikic/scalar/docString.php");
fixture_test!(scalar_encapsedstring, "nikic/scalar/encapsedString.php");
fixture_test!(scalar_explicitoctal, "nikic/scalar/explicitOctal.php");
fixture_test!(scalar_float, "nikic/scalar/float.php");
fixture_test!(scalar_invalidoctal_1, "nikic/scalar/invalidOctal_1.php");
fixture_test!(scalar_invalidoctal_2, "nikic/scalar/invalidOctal_2.php");
fixture_test!(scalar_magicconst, "nikic/scalar/magicConst.php");
fixture_test!(
    scalar_numberseparators,
    "nikic/scalar/numberSeparators.php",
    errors
);
fixture_test!(scalar_unicodeescape_1, "nikic/scalar/unicodeEscape_1.php");
fixture_test!(scalar_unicodeescape_2, "nikic/scalar/unicodeEscape_2.php");
fixture_test!(scalar_unicodeescape_3, "nikic/scalar/unicodeEscape_3.php");

// stmt
fixture_test!(stmt_attributes, "nikic/stmt/attributes.php");
fixture_test!(stmt_blocklessstatement, "nikic/stmt/blocklessStatement.php");
fixture_test!(stmt_class_abstract, "nikic/stmt/class/abstract.php");
fixture_test!(stmt_class_anonymous, "nikic/stmt/class/anonymous.php");
fixture_test!(
    stmt_class_asymmetric_visibility_1,
    "nikic/stmt/class/asymmetric_visibility_1.php"
);
fixture_test!(
    stmt_class_asymmetric_visibility_2,
    "nikic/stmt/class/asymmetric_visibility_2.php"
);
fixture_test!(
    stmt_class_class_position_1,
    "nikic/stmt/class/class_position_1.php"
);
fixture_test!(
    stmt_class_class_position_2,
    "nikic/stmt/class/class_position_2.php"
);
fixture_test!(
    stmt_class_class_position_3,
    "nikic/stmt/class/class_position_3.php"
);
fixture_test!(stmt_class_conditional, "nikic/stmt/class/conditional.php");
fixture_test!(
    stmt_class_constmodifiererrors_1,
    "nikic/stmt/class/constModifierErrors_1.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_2,
    "nikic/stmt/class/constModifierErrors_2.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_3,
    "nikic/stmt/class/constModifierErrors_3.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_4,
    "nikic/stmt/class/constModifierErrors_4.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiers,
    "nikic/stmt/class/constModifiers.php"
);
fixture_test!(stmt_class_enum, "nikic/stmt/class/enum.php", errors);
fixture_test!(
    stmt_class_enum_with_string,
    "nikic/stmt/class/enum_with_string.php"
);
fixture_test!(stmt_class_final, "nikic/stmt/class/final.php");
fixture_test!(
    stmt_class_implicitpublic,
    "nikic/stmt/class/implicitPublic.php"
);
fixture_test!(stmt_class_interface, "nikic/stmt/class/interface.php");
fixture_test!(
    stmt_class_modifier_error_1,
    "nikic/stmt/class/modifier_error_1.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_2,
    "nikic/stmt/class/modifier_error_2.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_3,
    "nikic/stmt/class/modifier_error_3.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_4,
    "nikic/stmt/class/modifier_error_4.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_5,
    "nikic/stmt/class/modifier_error_5.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_6,
    "nikic/stmt/class/modifier_error_6.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_7,
    "nikic/stmt/class/modifier_error_7.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_8,
    "nikic/stmt/class/modifier_error_8.php",
    errors
);
fixture_test!(stmt_class_name_1, "nikic/stmt/class/name_1.php", errors);
fixture_test!(stmt_class_name_2, "nikic/stmt/class/name_2.php", errors);
fixture_test!(stmt_class_name_3, "nikic/stmt/class/name_3.php", errors);
fixture_test!(stmt_class_name_4, "nikic/stmt/class/name_4.php", errors);
fixture_test!(stmt_class_name_5, "nikic/stmt/class/name_5.php", errors);
fixture_test!(stmt_class_name_6, "nikic/stmt/class/name_6.php", errors);
fixture_test!(stmt_class_name_7, "nikic/stmt/class/name_7.php", errors);
fixture_test!(stmt_class_name_8, "nikic/stmt/class/name_8.php", errors);
fixture_test!(stmt_class_name_9, "nikic/stmt/class/name_9.php", errors);
fixture_test!(stmt_class_name_10, "nikic/stmt/class/name_10.php", errors);
fixture_test!(stmt_class_name_11, "nikic/stmt/class/name_11.php", errors);
fixture_test!(stmt_class_name_12, "nikic/stmt/class/name_12.php", errors);
fixture_test!(stmt_class_name_13, "nikic/stmt/class/name_13.php", errors);
fixture_test!(stmt_class_name_14, "nikic/stmt/class/name_14.php", errors);
fixture_test!(stmt_class_name_15, "nikic/stmt/class/name_15.php", errors);
fixture_test!(
    stmt_class_php4style,
    "nikic/stmt/class/php4Style.php",
    errors
);
fixture_test!(
    stmt_class_propertytypes,
    "nikic/stmt/class/propertyTypes.php"
);
fixture_test!(
    stmt_class_property_hooks_1,
    "nikic/stmt/class/property_hooks_1.php"
);
fixture_test!(
    stmt_class_property_hooks_2,
    "nikic/stmt/class/property_hooks_2.php"
);
fixture_test!(
    stmt_class_property_hooks_3,
    "nikic/stmt/class/property_hooks_3.php"
);
fixture_test!(
    stmt_class_property_hooks_4,
    "nikic/stmt/class/property_hooks_4.php",
    errors
);
fixture_test!(
    stmt_class_property_hooks_5,
    "nikic/stmt/class/property_hooks_5.php",
    errors
);
fixture_test!(
    stmt_class_property_hooks_6,
    "nikic/stmt/class/property_hooks_6.php",
    errors
);
fixture_test!(
    stmt_class_property_hooks_7,
    "nikic/stmt/class/property_hooks_7.php",
    errors
);
fixture_test!(
    stmt_class_property_modifiers,
    "nikic/stmt/class/property_modifiers.php"
);
fixture_test!(
    stmt_class_property_promotion,
    "nikic/stmt/class/property_promotion.php"
);
fixture_test!(stmt_class_readonly_1, "nikic/stmt/class/readonly_1.php");
fixture_test!(stmt_class_readonly_2, "nikic/stmt/class/readonly_2.php");
fixture_test!(
    stmt_class_readonlyanonyous,
    "nikic/stmt/class/readonlyAnonyous.php"
);
fixture_test!(
    stmt_class_readonlyasclassname_1,
    "nikic/stmt/class/readonlyAsClassName_1.php",
    errors
);
fixture_test!(
    stmt_class_readonlyasclassname_2,
    "nikic/stmt/class/readonlyAsClassName_2.php",
    errors
);
fixture_test!(
    stmt_class_readonlymethod,
    "nikic/stmt/class/readonlyMethod.php"
);
fixture_test!(
    stmt_class_shortechoasidentifier,
    "nikic/stmt/class/shortEchoAsIdentifier.php",
    errors
);
fixture_test!(stmt_class_simple, "nikic/stmt/class/simple.php");
fixture_test!(
    stmt_class_staticmethod_1,
    "nikic/stmt/class/staticMethod_1.php"
);
fixture_test!(
    stmt_class_staticmethod_2,
    "nikic/stmt/class/staticMethod_2.php"
);
fixture_test!(
    stmt_class_staticmethod_3,
    "nikic/stmt/class/staticMethod_3.php"
);
fixture_test!(
    stmt_class_staticmethod_4,
    "nikic/stmt/class/staticMethod_4.php"
);
fixture_test!(
    stmt_class_staticmethod_5,
    "nikic/stmt/class/staticMethod_5.php"
);
fixture_test!(
    stmt_class_staticmethod_6,
    "nikic/stmt/class/staticMethod_6.php"
);
fixture_test!(stmt_class_statictype, "nikic/stmt/class/staticType.php");
fixture_test!(stmt_class_trait, "nikic/stmt/class/trait.php");
fixture_test!(
    stmt_class_typedconstants,
    "nikic/stmt/class/typedConstants.php"
);
fixture_test!(stmt_const, "nikic/stmt/const.php", errors);
fixture_test!(stmt_controlflow, "nikic/stmt/controlFlow.php");
fixture_test!(stmt_declare, "nikic/stmt/declare.php");
fixture_test!(stmt_echo, "nikic/stmt/echo.php");
fixture_test!(
    stmt_function_builtintypedeclarations,
    "nikic/stmt/function/builtinTypeDeclarations.php"
);
fixture_test!(stmt_function_byref, "nikic/stmt/function/byRef.php");
fixture_test!(
    stmt_function_clone_function,
    "nikic/stmt/function/clone_function.php"
);
fixture_test!(
    stmt_function_conditional,
    "nikic/stmt/function/conditional.php"
);
fixture_test!(
    stmt_function_defaultvalues,
    "nikic/stmt/function/defaultValues.php"
);
fixture_test!(
    stmt_function_disjointnormalformtypes,
    "nikic/stmt/function/disjointNormalFormTypes.php"
);
fixture_test!(
    stmt_function_exit_die_function,
    "nikic/stmt/function/exit_die_function.php"
);
fixture_test!(
    stmt_function_intersectiontypes,
    "nikic/stmt/function/intersectionTypes.php"
);
fixture_test!(stmt_function_nevertype, "nikic/stmt/function/neverType.php");
fixture_test!(
    stmt_function_nullfalsetruetypes_1,
    "nikic/stmt/function/nullFalseTrueTypes_1.php"
);
fixture_test!(
    stmt_function_nullfalsetruetypes_2,
    "nikic/stmt/function/nullFalseTrueTypes_2.php"
);
fixture_test!(
    stmt_function_nullabletypes,
    "nikic/stmt/function/nullableTypes.php"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_1,
    "nikic/stmt/function/parameters_trailing_comma_1.php"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_2,
    "nikic/stmt/function/parameters_trailing_comma_2.php"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_3,
    "nikic/stmt/function/parameters_trailing_comma_3.php"
);
fixture_test!(
    stmt_function_readonlyfunction,
    "nikic/stmt/function/readonlyFunction.php"
);
fixture_test!(
    stmt_function_returntypes,
    "nikic/stmt/function/returnTypes.php"
);
fixture_test!(
    stmt_function_specialvars,
    "nikic/stmt/function/specialVars.php"
);
fixture_test!(
    stmt_function_typedeclarations,
    "nikic/stmt/function/typeDeclarations.php"
);
fixture_test!(
    stmt_function_typeversions_1,
    "nikic/stmt/function/typeVersions_1.php"
);
fixture_test!(
    stmt_function_typeversions_2,
    "nikic/stmt/function/typeVersions_2.php"
);
fixture_test!(
    stmt_function_typeversions_3,
    "nikic/stmt/function/typeVersions_3.php"
);
fixture_test!(
    stmt_function_typeversions_4,
    "nikic/stmt/function/typeVersions_4.php"
);
fixture_test!(
    stmt_function_typeversions_5,
    "nikic/stmt/function/typeVersions_5.php"
);
fixture_test!(
    stmt_function_typeversions_6,
    "nikic/stmt/function/typeVersions_6.php"
);
fixture_test!(
    stmt_function_uniontypes,
    "nikic/stmt/function/unionTypes.php"
);
fixture_test!(stmt_function_variadic, "nikic/stmt/function/variadic.php");
fixture_test!(
    stmt_function_variadicdefaultvalue,
    "nikic/stmt/function/variadicDefaultValue.php"
);
fixture_test!(stmt_generator_basic, "nikic/stmt/generator/basic.php");
fixture_test!(
    stmt_generator_yieldprecedence,
    "nikic/stmt/generator/yieldPrecedence.php"
);
fixture_test!(
    stmt_generator_yieldunaryprecedence,
    "nikic/stmt/generator/yieldUnaryPrecedence.php"
);
fixture_test!(stmt_haltcompiler_1, "nikic/stmt/haltCompiler_1.php");
fixture_test!(stmt_haltcompiler_2, "nikic/stmt/haltCompiler_2.php");
fixture_test!(stmt_haltcompiler_3, "nikic/stmt/haltCompiler_3.php");
fixture_test!(
    stmt_haltcompilerinvalidsyntax,
    "nikic/stmt/haltCompilerInvalidSyntax.php",
    errors
);
fixture_test!(stmt_haltcompileroffset, "nikic/stmt/haltCompilerOffset.php");
fixture_test!(
    stmt_haltcompileroutermostscope,
    "nikic/stmt/haltCompilerOutermostScope.php",
    errors
);
fixture_test!(stmt_hashbang, "nikic/stmt/hashbang.php");
fixture_test!(stmt_if, "nikic/stmt/if.php");
fixture_test!(stmt_inlinehtml, "nikic/stmt/inlineHTML.php");
fixture_test!(stmt_loop_do, "nikic/stmt/loop/do.php");
fixture_test!(stmt_loop_for, "nikic/stmt/loop/for.php");
fixture_test!(stmt_loop_foreach, "nikic/stmt/loop/foreach.php");
fixture_test!(stmt_loop_while, "nikic/stmt/loop/while.php");
fixture_test!(stmt_multicatch, "nikic/stmt/multiCatch.php");
fixture_test!(stmt_namespace_alias, "nikic/stmt/namespace/alias.php");
fixture_test!(stmt_namespace_braced, "nikic/stmt/namespace/braced.php");
fixture_test!(
    stmt_namespace_commentafternamespace,
    "nikic/stmt/namespace/commentAfterNamespace.php"
);
fixture_test!(stmt_namespace_groupuse, "nikic/stmt/namespace/groupUse.php");
fixture_test!(
    stmt_namespace_groupuseerrors_1,
    "nikic/stmt/namespace/groupUseErrors_1.php",
    errors
);
fixture_test!(
    stmt_namespace_groupuseerrors_2,
    "nikic/stmt/namespace/groupUseErrors_2.php",
    errors
);
fixture_test!(
    stmt_namespace_groupuseerrors_3,
    "nikic/stmt/namespace/groupUseErrors_3.php",
    errors
);
fixture_test!(
    stmt_namespace_groupusepositions,
    "nikic/stmt/namespace/groupUsePositions.php"
);
fixture_test!(
    stmt_namespace_groupusetrailingcomma,
    "nikic/stmt/namespace/groupUseTrailingComma.php"
);
fixture_test!(
    stmt_namespace_invalidname_1,
    "nikic/stmt/namespace/invalidName_1.php",
    errors
);
fixture_test!(
    stmt_namespace_invalidname_2,
    "nikic/stmt/namespace/invalidName_2.php",
    errors
);
fixture_test!(
    stmt_namespace_invalidname_3,
    "nikic/stmt/namespace/invalidName_3.php",
    errors
);
fixture_test!(stmt_namespace_mix_1, "nikic/stmt/namespace/mix_1.php");
fixture_test!(stmt_namespace_mix_2, "nikic/stmt/namespace/mix_2.php");
fixture_test!(stmt_namespace_name, "nikic/stmt/namespace/name.php");
fixture_test!(stmt_namespace_nested, "nikic/stmt/namespace/nested.php");
fixture_test!(
    stmt_namespace_notbraced,
    "nikic/stmt/namespace/notBraced.php"
);
fixture_test!(
    stmt_namespace_nsafterhashbang,
    "nikic/stmt/namespace/nsAfterHashbang.php"
);
fixture_test!(
    stmt_namespace_outsidestmt_1,
    "nikic/stmt/namespace/outsideStmt_1.php"
);
fixture_test!(
    stmt_namespace_outsidestmt_2,
    "nikic/stmt/namespace/outsideStmt_2.php"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_1,
    "nikic/stmt/namespace/outsideStmtInvalid_1.php"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_2,
    "nikic/stmt/namespace/outsideStmtInvalid_2.php"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_3,
    "nikic/stmt/namespace/outsideStmtInvalid_3.php"
);
fixture_test!(stmt_newininitializer, "nikic/stmt/newInInitializer.php");
fixture_test!(stmt_switch, "nikic/stmt/switch.php");
fixture_test!(stmt_trycatch, "nikic/stmt/tryCatch.php");
fixture_test!(
    stmt_trycatch_without_variable,
    "nikic/stmt/tryCatch_without_variable.php"
);
fixture_test!(
    stmt_trywithoutcatch,
    "nikic/stmt/tryWithoutCatch.php",
    errors
);
fixture_test!(stmt_unset, "nikic/stmt/unset.php");
fixture_test!(stmt_voidcast, "nikic/stmt/voidCast.php");
